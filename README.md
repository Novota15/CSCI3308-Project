# CSCI3308-Project: Stock Explorer

### Requirements

The requirements for the python scripts are located in *requirements.txt*

* Python 3.7
    * Web Development:
        ```
        Flask
        ```
    * Visualization
        ```
        chartify >= 2.6.0
        ```
    * Stock Analysis:
        ```
        quandl >= 3.3.0
        matplotlib >= 2.1.1
        numpy >= 1.14.0
        fbprophet >= 0.2.1
        pystan >= 2.17.0.0
        pandas >= 0.22.0
        pytrends >= 4.3.0
        yfinance
        datetime
        ```
Use `pip3 install PACKAGE_NAME` to make these available for importing.

pytrends and fbprophet can run into problems installing with pip. The Anaconda distribution of Python may be needed to install. [Guide](https://facebook.github.io/prophet/docs/installation.html)

### Set-Up

Make sure all of the dependencies are installed.

To start the flask web app, run stock-explorer.py
