# GardenManager API

## Configuration

The project use dotenv (`symfony/dotenv` package) to handle loading of .env files.
The order which way the files are loaded is the following:

- `.env` (`.env.dist` if not found)
- `.env.local` (except when environment is test)
- Environment specific .env (like `.env.dev`)
- Environment specific local .env (`.env.dev.local`)

Environment is always specified by the root level (`.env` or `.env.dist`) file `APP_ENV` key.
