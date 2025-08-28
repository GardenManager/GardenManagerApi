# GardenManager API

## Configuration

The project use dotenv (`symfony/dotenv` package) to handle loading of .env files.
The order which way the files are loaded is the following:

- `.env` (`.env.dist` if not found)
- `.env.local` (except when environment is test)
- Environment specific .env (like `.env.dev`)
- Environment specific local .env (`.env.dev.local`)

Environment is always specified by the root level (`.env` or `.env.dist`) file `APP_ENV` key.

## Routes and callable invocation

Routing is handling trough slim framework (which uses fastroute) but to make it more convenient routes can be provided
from separate files these files must be paced inside `/app/routes` folder and must return a class that implements `GardenManager\Api\Infrastructure\Core\Http\Contract\RouteProviderInterface`

The provider support files only in a single level, so no sub-folders are allowed.

### Invocation

Invocation works similar to slim framework itself but with a few added bonus:

- Callables are able to fetch services directly from the container (Uses php-di invoker)
- Route arguments can be accessed from both `$args` and `$arguments` parameter
- Route arguments gets defined as route attributes
