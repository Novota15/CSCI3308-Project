from flask import Flask
from flask import request
from flask import render_template
from flask import send_file

from MarketData.stocker import Stocker

app = Flask(__name__)

class History_Plot():
    def __init__(self, stock, ticker):
        # time parameters
        self.start_date = ""
        self.end_date = ""
        # historical price values as string statements
        self.historic_max, self.historic_min, self.current = stock.plot_stock()
        self.filepath = ticker + ".png"

class Prophet_Model():
    def __init__(self, stock, ticker, days=0):
        # of days into the future to predict
        self.days = days
        self.model, self.model_data = stock.create_prophet_model(self.days)
        self.filepath = ticker + "-prophet-model.png"

class Trends_Plot():
    def __init__(self, model, model_data):
        self.filepath = ""

def plot_history(stock):
    historic_max, historic_min, current = stock.plot_stock()
    return historic_max, historic_min, current

def plot_prediction(stock):
    model, model_data = stock.create_prophet_model(days=0)
    return model, model_data

def plot_trends(model, model_data):
    model.plot_components(model_data)
    return

@app.route('/', methods=['GET','POST'])
def plot_input_post():
    if request.method == 'POST':
        # create stock object
        text = request.form['ticker']
        stock = Stocker(ticker=text)
        # plot the stock history
        # historic_max, historic_min, current_price = plot_history(stock)
        # machine learning predition
        # model, model_data = plot_prediction(stock)
        # trends
        # plot_trends(model, model_data)

        # define file paths for graphs
        # stock_plot = text + ".png"
        # prediction_plot = text + "-prophet-model.png"
        # create plot objects
        history_plot = History_Plot(stock, text)
        future_days = 0
        prophet_model = Prophet_Model(stock, text, future_days)
        trends_plot = Trends_Plot(prophet_model.model, prophet_model.model_data)
    else:
        stock = Stocker(ticker='MSFT')
        history_plot = History_Plot(stock, 'MSFT')
        future_days = 0
        prophet_model = Prophet_Model(stock, 'MSFT', future_days)
        trends_plot = Trends_Plot(prophet_model.model, prophet_model.model_data)
        #return render_template("Dashboard.html", stock_plot=stock_plot, historic_max=historic_max, historic_min=historic_min, current_price=current_price, prediction_plot=prediction_plot)
    return render_template("Dashboard.html", history_plot=history_plot, prophet_model=prophet_model, trends_plot=trends_plot)
    #return render_template("Dashboard.html", stock_plot="MSFT.png", prediction_plot="MSFT.png") # name of your html file, pass in variables



if __name__ == '__main__':
    app.run()