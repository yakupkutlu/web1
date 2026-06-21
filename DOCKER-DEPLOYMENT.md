# Docker Deployment

## Included files
- `Dockerfile` - builds a PHP 8.1 + Apache image with `mysqli` enabled.
- `docker-compose.yml` - runs the PHP app container and loads environment variables from `.env`.
- `.env` - holds the provided database and application configuration.
- `.dockerignore` - excludes common files from the Docker build context.

## Environment values used
- `APP_URL=https://dergi.ebilet24.com`
- `DB_HOST=h520c96krkd2chl60qa77qd3`
- `DB_NAME=journaleredb`
- `DB_USER=user_jeredb`
- `DB_PASSWORD=user_jere1*db`
- `DB_PORT=3306`

## Deployment steps
1. Open a terminal in the repository root:
   ```sh
   cd "c:\Users\Acer\Documents\dergisistemGIT"
   ```
2. Build and start the app container:
   ```sh
   docker compose up --build -d
   ```
3. Validate the service is running:
   ```sh
   docker compose ps
   ```
4. Open the app in a browser at:
   - `http://localhost`

## Notes
- `app/connect.php` now reads database credentials from environment variables.
- If your database is remote, ensure the container can resolve and connect to `DB_HOST`.
- If you need a local MySQL container instead of an external DB host, add a `db` service to `docker-compose.yml` and update `DB_HOST` to `db`.
