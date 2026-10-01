# Core4 Deployment Notes

## Health check

Use:

    /health.php

This endpoint intentionally has no database dependency and must return HTTP 200.

## Required production database variables

Set these in the deployment platform:

- `APP_ENV=production`
- `DB_HOST`
- `DB_PORT`
- `DB_NAME`
- `DB_USER`
- `DB_PASS`

Do not rely on localhost/root defaults in production.

## Optional diagnostics

Temporarily set:

    DIAGNOSTICS_ENABLED=true

Then request:

    /diagnostics/runtime.php

It reports PHP/runtime and database reachability without returning database credentials.

Set `DIAGNOSTICS_ENABLED=false` again after diagnosis.

## Database

Import the SQL schema in `database/database.sql` before using authenticated application modules.

## Deployment root

The Dockerfile and application files are located in the project root of this corrected archive. Deploy from that root.
