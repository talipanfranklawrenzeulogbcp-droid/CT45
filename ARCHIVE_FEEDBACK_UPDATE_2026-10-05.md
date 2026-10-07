# Feedback + Archive Update — 2026-10-05

- Administrator now has **Employee Feedback** in the user dropdown.
- Administrator can view employee feedback and delete it.
- Staff can continue to send and unsend their own feedback.
- Staff unsend and Administrator delete never hard-delete the feedback first: the complete feedback thread, messages, and related feedback notifications are copied into `archive_items` with `item_type='feedback'`, then removed from live tables.
- Archive UI now has a category filter for Employee Feedback, Records, and Files.
- Administrator can download a JSON backup of all archived data or only archived feedback.
- Archived feedback can be recovered, including its messages and notification linkage.
- Permanent deletion remains a separate Administrator-only action from the Archive.
- Existing database tables and workflow are preserved; changes are additive.
