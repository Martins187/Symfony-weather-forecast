Weather forecast app created with Symfony framework
---
This app takes your current ip address, determines the location 
and retrieves the curerent weather forecast in json.

### Setup

1. Make sure you have docker installed in your local environment. 
2. Clone the repository and go to the root diectory of the project. 
3. Provide valid API keys for 'http://ipstack.com/' and 
   'https://openweathermap.org' in the .env file.
4. Run command "docker-compose up".
5. The app will present the data at http://localhost:8181
6. To clear the cache and get renewed the data go to http://localhost:8181/renewData
