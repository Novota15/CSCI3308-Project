from flask import Flask
from flask import request
from flask import render_template
from flask import send_file
#import stringComparison
from MarketData.stocker import Stocker

app = Flask(__name__)

# @app.route('/')
# def plot_input():
#     return render_template("market-dash.html") # name of your html file, pass in variables

# can do get and post
# set a variable
# if request.method == 'POST' do post stuff

def plot_history(stock):
    stock.plot_stock()
    return

def plot_prediction(stock):
    model, model_data = stock.create_prophet_model()
    return model, model_data

@app.route('/', methods=['GET','POST'])
def plot_input_post():
    if request.method == 'POST':
        text = request.form['ticker']
        stock = Stocker(ticker=text)
        # stock.plot_stock()
        plot_history(stock)
        model, model_data = plot_prediction(stock)
        stock_plot = text + ".png"
        prediction_plot = text + "-prophet-model.png"
        # return send_file(filename, mimetype='image/png')
        return render_template("Dashboard.html", stock_plot=stock_plot, prediction_plot=prediction_plot)
    return render_template("Dashboard.html", stock_plot="MSFT.png", prediction_plot="MSFT.png") # name of your html file, pass in variables



if __name__ == '__main__':
    app.run()