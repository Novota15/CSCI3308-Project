# Plot objects
from MarketData.stocker import Stocker
import matplotlib.pyplot as plt
from datetime import datetime
from datetime import date
from datetime import timedelta

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