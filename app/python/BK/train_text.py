#Import packages
import pandas as pd
import numpy as np
import joblib
import tensorflow as tf
from sklearn.feature_extraction.text import TfidfVectorizer

#Load data
X = pd.read_csv('C:\\Users\\HP\\data\\IMDB Dataset.csv')

x_train, y_train = X[0:2000]['review'], X[0:2000]['sentiment']
#x_test, y_test = X[2000:4000]['review'], X[2000:4000]['sentiment']

VOCAB_SIZE = 1000
trans = TfidfVectorizer(max_features=VOCAB_SIZE)
trans = trans.fit(x_train)

vocab = trans.get_feature_names()
x_train = trans.transform(x_train).toarray()
#x_test = trans.transform(x_test).toarray()

y_train = np.where(y_train == 'positive', 1, 0)
#y_test = np.where(y_test == 'positive', 1, 0)

#y_train = np.expand_dims(y_train, axis=1)
#y_test = np.expand_dims(y_test, axis=1)

# Build model
model = tf.keras.Sequential()
model.add(tf.keras.layers.Dense(100, activation='relu'))
model.add(tf.keras.layers.Dense(1))

# Complie model
model.compile(optimizer='adam',
    loss=tf.keras.losses.BinaryCrossentropy(from_logits=True),
    metrics=['accuracy'])

# Train model
model.fit(x_train, y_train, epochs=20,verbose=0)

#export model
joblib.dump(trans, 'C:\\xampp\\htdocs\\shoppee\\app\\python\\text\\trans.pkl')
model.save('C:\\xampp\\htdocs\\shoppee\\app\\python\\text')

print('success')