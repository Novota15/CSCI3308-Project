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
@app.route('/', methods=['GET','POST'])
def plot_input_post():
    if request.method == 'POST':
        text = request.form['ticker']
        stock = Stocker(ticker=text)
        stock.plot_stock()
        filename = text + ".png"
        # return send_file(filename, mimetype='image/png')
        return render_template("market-dash.html", filename=filename)
    return render_template("market-dash.html", filename="MSFT.png") # name of your html file, pass in variables



if __name__ == '__main__':
    app.run()