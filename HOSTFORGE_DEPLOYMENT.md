# HostForge deployment settings

This application runs Apache/PHP inside the container on **port 80**.

Use these HostForge Advanced settings:

- **Port:** `80`
- **Health check path:** `/health/`
- **Protocol:** HTTP

The image also declares `EXPOSE 80/tcp` and a Docker `HEALTHCHECK` against `/health/`.

## Environment variables

Configure the application's runtime secrets in HostForge rather than committing them:

- `GSMS_DB_HOST`
- `GSMS_DB_NAME`
- `GSMS_DB_USER`
- `GSMS_DB_PASS`
- `GSMS_MAIL_USERNAME`
- `GSMS_MAIL_PASSWORD`
- `GSMS_MAIL_FROM_EMAIL`
- `GSMS_OTP_SENDER_EMAIL`
- `GEMINI_API_KEY`
- `GEMINI_MODEL` (optional)

The health endpoint intentionally returns HTTP 200 without requiring MySQL, so a database outage does not make the container fail a basic liveness probe. It reports database/dependency state in its JSON response for diagnostics.
