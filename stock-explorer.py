from flask import Flask
from flask import request
from flask import render_template
from flask import send_file
import matplotlib.pyplot as plt
from datetime import datetime
from datetime import date
from datetime import timedelta

from MarketData.stocker import Stocker
import plots as Plots

import os
from os import path

app = Flask(__name__)
app.url_map.strict_slashes = False

# initialize some default stock data for faster loading
yesterday = datetime.now() - timedelta(days=4)
yesterday.strftime('%Y-%m-%d')
history_plot_start_date = datetime(2014,1,1)
history_plot_end_date = yesterday
future_days = 10
# create stock object
text = 'MSFT'
stock = Stocker(ticker=text)
# create plot objects
history_plot = Plots.History_Plot(stock, text, history_plot_start_date, history_plot_end_date)
prophet_model = Plots.Prophet_Model(stock, text, future_days)
trends_plot = Plots.Trends_Plot(text, prophet_model.model, prophet_model.model_data)
changept_search = ""
change_points_date = Plots.Change_Points_Date(stock, text, changept_search)
# potential_profit = Potential_Profit(stock, text, potential_profit_start_date, potential_profit_end_date, nshares)

@app.route('/', methods=['GET','POST'])
def default_page():
    if request.method == 'POST':
        return render_template("landing-page.html")
    return render_template("landing-page.html")

@app.route('/landing-page.html', methods=['GET','POST'])
def landing_page():
    if request.method == 'POST':
        return render_template("landing-page.html")
    return render_template("landing-page.html")

@app.route('/login.html', methods=['GET','POST'])
def login_page():
    if request.method == 'POST':
        return render_template("login.html")
    return render_template("login.html")

@app.route('/register.html', methods=['GET','POST'])
def registration_page():
    if request.method == 'POST':
        return render_template("register.html")
    return render_template("register.html")

@app.route('/profile.html', methods=['GET','POST'])
def profile_page():
    if request.method == 'POST':
        return render_template("profile.html")
    return render_template("profile.html")

@app.route('/settings.html', methods=['GET','POST'])
def settings_page():
    if request.method == 'POST':
        return render_template("settings.html")
    return render_template("settings.html")

@app.route('/dashboard.html/history_start', methods=['GET','POST'])
def history_plot_start_func():
    global text
    global stock
    global history_plot
    global prophet_model
    global trends_plot
    global change_points_date
    history_plot_start_date = request.form['history_plot_start']
    history_plot = Plots.History_Plot(stock, text, history_plot_start_date, history_plot_end_date)
    
    return render_template("dashboard.html", history_plot=history_plot, prophet_model=prophet_model, trends_plot=trends_plot, change_points_date=change_points_date)

@app.route('/dashboard.html/prediction', methods=['GET','POST'])
def prediction_func():
    global text
    global stock
    global history_plot
    global prophet_model
    global trends_plot
    global change_points_date
    global future_days
    future_days = int(request.form['future_days'])
    prophet_model = Plots.Prophet_Model(stock, text, future_days)
    return render_template("dashboard.html", history_plot=history_plot, prophet_model=prophet_model, trends_plot=trends_plot, change_points_date=change_points_date)


@app.route('/dashboard.html', methods=['GET','POST'])
def dashboard():
    yesterday = datetime.now() - timedelta(days=4)
    yesterday.strftime('%Y-%m-%d')
    # print(yesterday)
    global text
    global stock
    global history_plot
    global prophet_model
    global trends_plot
    global change_points_date
    if request.method == 'POST':
        text = request.form['ticker']
        # settings parameters
        # history plot
        history_plot_start_date = datetime(2014,1,1)
        history_plot_end_date = yesterday
        # prophet model
        future_days = 10
        # potential profit plot
        # potential_profit_start_date = datetime(2014,1,1)
        # potential_profit_end_date = yesterday
        # nshares = 100
    else:
        return render_template("dashboard.html", history_plot=history_plot, prophet_model=prophet_model, trends_plot=trends_plot, change_points_date=change_points_date)

        # default is microsoft stock
        # text = 'MSFT'
        # history plot
        # history_plot_start_date = datetime(2014,1,1)
        # history_plot_end_date = yesterday
        # prophet model
        # future_days = 10
        # potential profit model
        # potential_profit_start_date = datetime(2014,1,1)
        # potential_profit_end_date = yesterday
        # nshares = 100
    # create stock object
    stock = Stocker(ticker=text)
    # create plot objects
    history_plot = Plots.History_Plot(stock, text, history_plot_start_date, history_plot_end_date)
    prophet_model = Plots.Prophet_Model(stock, text, future_days)
    trends_plot = Plots.Trends_Plot(text, prophet_model.model, prophet_model.model_data)
    changept_search = ""
    change_points_date = Plots.Change_Points_Date(stock, text, changept_search)
    # potential_profit = Potential_Profit(stock, text, potential_profit_start_date, potential_profit_end_date, nshares)

    return render_template("dashboard.html", history_plot=history_plot, prophet_model=prophet_model, trends_plot=trends_plot, change_points_date=change_points_date)

if __name__ == '__main__':
    extra_dirs = ['/c/Users/gtnov/Documents/GitHub/CSCI3308-Project/static',]
    extra_files = extra_dirs[:]
    for extra_dir in extra_dirs:
        for dirname, dirs, files in os.walk(extra_dir):
            for filename in files:
                filename = path.join(dirname, filename)
                if path.isfile(filename):
                    extra_files.append(filename)
                    print(filename)
    app.run(extra_files=extra_files)
    # app.run()