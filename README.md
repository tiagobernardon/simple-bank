# Developer Test

## Running the project locally

### Prerequisites

- [WSL2](https://learn.microsoft.com/en-us/windows/wsl/install)
- [Docker](https://www.docker.com/get-started/)

## Installation

1. **First, clone the project:**
```
git clone https://github.com/tiagobernardon/developer-test.git
```

2. **Now, navigate to the project directory to proceed with the installation:**
```
cd developer-test
```

3. **Let's access the frontend folder to start Docker. In PowerShell, follow the steps below:**
```
cd frontend
```

4. **Next, run the docker build:**
```
docker build -t frontend .
```

5. **And the docker run:**
```
docker run -d -p 3000:3000 frontend
```

6. **Now let's configure the backend. Go back to the root of the project:**
```
cd ../
```

7. **Access the backend directory:**
```
cd backend
```

8. **Run the docker command to install dependencies with Composer:**
```
docker run --rm `
    -v "${PWD}:/var/www/html" `
    -w /var/www/html `
    laravelsail/php83-composer:latest `
    composer install --ignore-platform-reqs
```

9. **Now, start a new WSL session:**
```
wsl
```

10. **Copy the environment variables:**
```
cp .env.localexample .env
```

11. **Now let's run the backend with Laravel Sail:**
```
./vendor/bin/sail up -d
```

11. **Next, generate a key for our application:**
```
./vendor/bin/sail artisan key:generate
```

12. **Almost there! Now let's migrate the PostgreSQL database tables:**
```
./vendor/bin/sail artisan migrate:fresh
```

13. **Finally, run the database seeders:**
```
./vendor/bin/sail artisan db:seed
```

## Running the Tests
The application contains test files to test some user authentication scenarios. To run the tests, simply use:
```
./vendor/bin/sail artisan test
```
