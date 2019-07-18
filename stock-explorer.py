from flask import Flask
from flask import request
from flask import render_template
from flask import send_file
import matplotlib.pyplot as plt

from MarketData.stocker import Stocker

app = Flask(__name__)

# Each plot is an object
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

@app.route('/', methods=['GET','POST'])
def plot_input_post():
    if request.method == 'POST':
        text = request.form['ticker']
    else:
        # default is microsoft stock
        text = 'MSFT'
    # create stock object
    stock = Stocker(ticker=text)
    # create plot objects
    history_plot = History_Plot(stock, text)
    future_days = 10
    prophet_model = Prophet_Model(stock, text, future_days)
    trends_plot = Trends_Plot(text, prophet_model.model, prophet_model.model_data)
    changept_search = ""
    change_points_date = Change_Points_Date(stock, text, changept_search)

    return render_template("Dashboard.html", history_plot=history_plot, prophet_model=prophet_model, trends_plot=trends_plot, change_points_date=change_points_date)

if __name__ == '__main__':
    app.run()