# CT4 OTP / Runtime Fix — 2026-10-07

Changes preserve the existing UI, workflow, and database records.

- OTP now requires the `otp_requests` table to be successfully created/available; schema failures are logged instead of silently hidden.
- Runtime migration warnings are logged to `storage/logs/runtime.log`.
- OTP mail errors are logged to `storage/logs/otp-mail.log`.
- Login now keeps actionable runtime error messages instead of replacing every exception with the same generic message.
- The supplied `.env` is loaded by `includes/config.php`; deployment environment variables still take precedence.
- Docker no longer deletes `.env` during image build.
- Existing database schema/data is not reset or replaced.

**Security:** the supplied `.env` contains live credentials. Keep the ZIP private and rotate the database/Gmail/Gemini credentials if the archive is ever shared publicly.
