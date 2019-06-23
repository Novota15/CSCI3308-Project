#yahoo test code
from yahoo_finance import Share

yahoo = Share('MSFT')
print(yahoo.get_price())
print(yahoo.get_historical('2014-04-25', '2019-01-01'))