#Import python package
import pandas as pd
import joblib
#import mysql.connector as sql
#import cx_Oracle
import warnings
from sklearn.neural_network import MLPRegressor
warnings.filterwarnings("ignore")


#Load data
X = pd.read_csv("price_house.csv")

# conn=sql.connect(host="localhost", database="shopdee", 
#                  user="root", password="")
# query="SELECT * FROM houseprice"
# X=pd.read_sql(query,conn)

# dsn_tns = cx_Oracle.makedsn('localhost', '1521', 'orcl')
# conn = cx_Oracle.connect(user='shopdee', password='1234', dsn=dsn_tns)
# query = 'select * from houseprice'
# X = pd.read_sql(query,conn)

x=X.iloc[:, 1:len(X.columns)-1]
y=X.iloc[:, len(X.columns)-1]

#Build Model
net = MLPRegressor(solver='adam',activation='relu',
                        hidden_layer_sizes=3, 
                        learning_rate_init=0.01,
                        max_iter=1000)   
net.fit(x,y)


#export model
path='house_price_model.pkl'
joblib.dump(net, path)

print('success')