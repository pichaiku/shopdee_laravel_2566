#Import python package
import joblib
import numpy as np
import sys
import warnings
warnings.filterwarnings("ignore")

#Receive data
path=sys.argv[1] #Model path
age=int(sys.argv[2]) #In term of year
distance=int(sys.argv[3]) #In term of meters)
minimart=int(sys.argv[4])
x=np.array([[age, distance, minimart]])
# x = np.array([[21, 500, 5]])

#Load model
net=joblib.load(path)

#Test Model
y=net.predict(x)
print(round(y[0],2))