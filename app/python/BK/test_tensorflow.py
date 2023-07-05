#Import python package
import tensorflow as tf
import numpy as np
import sys

#Load data

year=int(sys.argv[1])
age=int(sys.argv[2])
distance=int(sys.argv[3])
minimart=int(sys.argv[4])
x=np.array([[year, age, distance, minimart]])
# x = np.array([[2000, 21, 500, 100]])

#load model
model = tf.keras.models.load_model('C:\\xampp\\htdocs\\shoppee\\app\\python\\cnn')

#Test Model
y = model.predict(x)[0][0]
print(round(y,2))