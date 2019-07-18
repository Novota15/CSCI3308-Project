from flask import Flask
from flask import request
from flask import render_template
from flask import send_file
import matplotlib.pyplot as plt
from datetime import datetime
from datetime import date
from datetime import timedelta

from MarketData.stocker import Stocker

app = Flask(__name__)

# Each plot is an object
class History_Plot():
    def __init__(self, stock, ticker, start_date, end_date):
        # time parameters
        self.start_date = start_date
        self.end_date = end_date
        # historical price values as string statements
        self.historic_max, self.historic_min, self.current = stock.plot_stock(start_date, end_date)
        self.filepath = ticker + ".png"

class Prophet_Model():
    def __init__(self, stock, ticker, days=0):
        # of days into the future to predict
        self.days = days
        self.model, self.model_data, self.predicted_price = stock.create_prophet_model(self.days)
        self.filepath = ticker + "-prophet-model.png"

class Trends_Plot():
    def __init__(self, ticker, model, model_data):
        model.plot_components(model_data)
        fig = plt.gcf()
        fig.savefig("./static/" + ticker + "-trends-plot.png", dpi=100)
        fig.clear()
        self.filepath = ticker + "-trends-plot.png"

class Change_Points_Date():
    def __init__(self, stock, ticker, changept_search):
        self.summary = stock.changepoint_date_analysis(search=changept_search)
        self.filepath = ticker + "-changepoint-date-analysis.png"

class Potential_Profit():
    def __init__(self, stock, ticker, start_date, end_date, nshares):
        # self.result = stock.buy_and_hold(start_date=start_date, end_date=end_date, nshares=nshares)
        self.result = stock.buy_and_hold(nshares=100)
        self.filepath = ticker + "-potential-profit.png"

@app.route('/', methods=['GET','POST'])
def plot_input_post():
    yesterday = datetime.now() - timedelta(days=3)
    yesterday.strftime('%Y-%m-%d')
    print(yesterday)
    if request.method == 'POST':
        text = request.form['ticker']
        # settings parameters
        # history plot
        history_plot_start_date = datetime(2014,1,1)
        history_plot_end_date = yesterday
        # prophet model
        future_days = 10
        # potential profit plot
        potential_profit_start_date = datetime(2014,1,1)
        potential_profit_end_date = yesterday
        nshares = 100
    else:
        # default is microsoft stock
        text = 'MSFT'
        # history plot
        history_plot_start_date = datetime(2014,1,1)
        history_plot_end_date = yesterday
        # prophet model
        future_days = 10
        # potential profit model
        potential_profit_start_date = datetime(2014,1,1)
        potential_profit_end_date = yesterday
        nshares = 100
    # create stock object
    stock = Stocker(ticker=text)
    # create plot objects
    history_plot = History_Plot(stock, text, history_plot_start_date, history_plot_end_date)
    prophet_model = Prophet_Model(stock, text, future_days)
    trends_plot = Trends_Plot(text, prophet_model.model, prophet_model.model_data)
    changept_search = ""
    change_points_date = Change_Points_Date(stock, text, changept_search)
    potential_profit = Potential_Profit(stock, text, potential_profit_start_date, potential_profit_end_date, nshares)

    return render_template("Dashboard.html", history_plot=history_plot, prophet_model=prophet_model, trends_plot=trends_plot, change_points_date=change_points_date, potential_profit=potential_profit)

if __name__ == '__main__':
    app.run()