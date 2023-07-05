#Import python package
import pandas as pd
import cx_Oracle
import tensorflow as tf

#Load data
X = pd.read_csv("C:\\xampp\\htdocs\\shoppee\\app\\python\\price_house.csv")

# conn=sql.connect(host="localhost", database="shopdee", 
#                  user="root", password="")
# query="SELECT * FROM houseprice"
# X=pd.read_sql(query,conn)

# dsn_tns = cx_Oracle.makedsn('localhost', '1521', 'orcl')
# conn = cx_Oracle.connect(user='shopdee', password='1234', dsn=dsn_tns)
# query = 'select * from houseprice'
# X = pd.read_sql(query,conn)

y=X.iloc[:,len(X.columns)-1]
x=X.iloc[:,1:len(X.columns)-1]


# Build model
model = tf.keras.Sequential()
model.add(tf.keras.layers.Dense(100, activation='relu'))
model.add(tf.keras.layers.Dense(1))

# Summary model

# Compile and train model
model.compile(optimizer='adam',
              loss='mean_squared_error',
              metrics='mean_squared_error')

model.fit(x, y, epochs=200, 
                    validation_data=(x, y),verbose=0)
model.save('C:\\xampp\\htdocs\\shoppee\\app\\python\\cnn')
print('success')