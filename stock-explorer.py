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

class Change_Points_Date():
    def __init__(self, stock, ticker):
        stock.changepoint_date_analysis()
        self.filepath = ticker + "-changepoint-date-analysis.png"

@app.route('/', methods=['GET','POST'])
def plot_input_post():
    if request.method == 'POST':
        # create stock object
        text = request.form['ticker']
    else:
        # default is microsoft stock
        text = 'MSFT'
    stock = Stocker(ticker=text)
    # create plot objects
    history_plot = History_Plot(stock, text)
    future_days = 0
    prophet_model = Prophet_Model(stock, text, future_days)
    trends_plot = Trends_Plot(prophet_model.model, prophet_model.model_data)
    change_points_date = Change_Points_Date(stock, text)

    return render_template("Dashboard.html", history_plot=history_plot, prophet_model=prophet_model, trends_plot=trends_plot, change_points_date=change_points_date)

if __name__ == '__main__':
    app.run()