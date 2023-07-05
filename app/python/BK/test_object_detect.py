#Import python package
import tensorflow as tf
import numpy as np
import skimage.io as io
from skimage.transform import resize
import sys
import joblib
import warnings
warnings.filterwarnings("ignore")

#Load data
filename = sys.argv[1]
#filename = 'C:\\Users\\HP\\data\\images\\test\\9326871.1.jpg' 
image=io.imread(filename)
image = resize(image, (32, 32))
x=np.expand_dims(image, axis=0)

#Load trans
trans=joblib.load('C:\\xampp\\htdocs\\shoppee\\app\\python\\face\\trans_variable.pkl')

#load model
model = tf.keras.models.load_model('C:\\xampp\\htdocs\\shoppee\\app\\python\\face')

#Test Model
y_pred = np.argmax(model.predict(x), axis=1)
y_pred = trans.inverse_transform(y_pred)[0]

print(y_pred)