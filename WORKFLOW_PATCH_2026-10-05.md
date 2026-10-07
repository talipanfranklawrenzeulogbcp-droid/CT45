# Workflow/UI Patch — 2026-10-05

Applied to the CT4 system while preserving the existing database schema and stored data.

## Changes
- Removed the dashboard Employee Feedback/My Feedback table and dashboard shortcut.
- Moved Feedback into the signed-in user dropdown for both Administrator and Staff.
- Feedback is now a one-way workflow: Send Feedback and Unsend Feedback.
- Removed reply UI and reply actions from the frontend and feedback endpoint.
- Existing reply-related database columns/tables are retained for compatibility; no new replies can be created by this build.
- Administrator accounts can submit their own feedback as well as view submitted feedback.
- A user can only unsend a feedback record owned by that same account.
- Tables retain all columns and are horizontally accessible; column headers have draggable resize grips.
- Normal table views show a maximum of five rows; existing Health/Incident/Login “show all” query flows remain available.
- Inline forms using `update_*` actions are converted to centered modal update forms without changing their POST action or database workflow.
- Existing scroll-position preservation and navigation behavior are retained.

## Validation
- PHP syntax checked with `php -l` across all PHP files.
- JavaScript syntax checked with Node.
- Static scan confirmed no active `reply`, `staff_reply`, or `feedback_reply` action remains in the updated feedback workflow.
