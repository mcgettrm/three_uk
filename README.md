# Michael McGettrick Three Tech Test

# Setup instructions
- Generate an API key for Alpha Avantage at the following URL: `https://www.alphavantage.co/support/#api-key`
- Place your API key for Alpha Avantage in `src\config.php` in the value of the "apiKey" property
- There are no composer dependencies for this app, however, you may need to run `composer install`
  if composer's autoloader isn't playing ball
- You will need to provide your database connection details in `src\config.php`, too.
- Import the `mysql.sql` file into your database of choice to get the schema set up.
- Configure your apache virtual host to serve from `three` folder so that index.php is hit

Note: There is a screenshot of the working output from development located
in the `/misc` folder.


# Future Considerations
The following are things I would consider if I had more time to work on this app:
- Load config from a some kind of persistent source e.g: .env / YAML.
- Keep codebase "stateless" by moving config outside of it.
- Use a service container and load classes through it.
- Use a router and a front controller.
- Unit tests.
- Add validation and throw exceptions from the Wrapper class if inputs are not appropriate or missing
- Load StockInformationDTO via a factory.
- Implement proper Controllers rather than scripts
- Use Monolog for logging
- Implement cURL without disabling the SSL Verification // Add debug mode to config object
- Use a templating engine for the initial page load (E.g: Twig)
- Set appropriate response headers on the ajax endpoint // Write some HTTP middleware?
- Conform ajax endpoint to REST standard
- Avoid $_GET superglobals in ajax script // More middleware
- Front end validation on the stockCode for better UX
- Better error handling within the backend application
- Build front end in React
- Potentially use a model class for the stock information coming out of the repository
- Recent transactions should update when ajax fires // Currently just loads once when index is loaded
- Restructure code layout in the /src folder

# Additional Information
- https://www.alphavantage.co/documentation/
- Original requirements are available in the "requirements" folder in the root of this App's directory

# Dependencies
- The app was built on a WAMP installation
- This app was only tested on PHP 7.4.20
- This app requires a MySQL database connection

# Example Endpoint Response:
```
{
    "Global Quote": {
    "01. symbol": "AMZN",
    "02. open": "140.4700",
    "03. high": "141.1100",
    "04. low": "137.9142",
    "05. price": "138.2300",
    "06. volume": "47792843",
    "07. latest trading day": "2022-08-19",
    "08. previous close": "142.3000",
    "09. change": "-4.0700",
    "10. change percent": "-2.8602%"
    }
}
```
