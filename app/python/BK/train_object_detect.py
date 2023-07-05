import tensorflow as tf
import skimage.io as io,os
import numpy as np
from skimage.transform import resize
from sklearn import preprocessing
import joblib
import warnings
warnings.filterwarnings("ignore")

#get training and test datasets
train_path='C:\\Users\HP\\data\images\\train\\'
#test_path='C:\\Users\HP\\data\images\\test\\'

def retriveData(path,length):
    labels=[]    
    i=0
    for filename in os.listdir(path):         
        image=io.imread(path + filename)
        image = resize(image, (32, 32))
        image=np.expand_dims(image, axis=0)
        if i==0 :
            images=np.copy(image)
        else:
            images=np.append(images,image,axis=0)
        labels=np.append(labels, filename.split(".")[0])
        i=i+1
        if i == length:
            break
    return images,labels

train_images,train_labels=retriveData(train_path, 2000)
#test_images,test_labels=retriveData(test_path,100)

#Transforma data (nomalize to [0-1])
#train_images, test_images = train_images / 255.0, test_images / 255.0 
train_images = train_images / 255.0

trans = preprocessing.LabelEncoder()
trans.fit(train_labels)


# Build model
model = tf.keras.models.Sequential()
model.add(tf.keras.layers.Conv2D(32, (3, 3), padding='same',                         
                    input_shape=(32, 32, 3)))
model.add(tf.keras.layers.MaxPooling2D((2, 2)))
model.add(tf.keras.layers.Conv2D(64, (3, 3), padding='same'))
model.add(tf.keras.layers.MaxPooling2D((2, 2)))
model.add(tf.keras.layers.Flatten())
model.add(tf.keras.layers.Dense(64))
#model.add(tf.keras.layers.Dropout(0.5))
model.add(tf.keras.layers.Dense(len(np.unique(train_labels))))

# Summary model
#model.summary()

# Complie model
model.compile(optimizer='adam',
    loss=tf.keras.losses.SparseCategoricalCrossentropy(from_logits=True),
    metrics=['accuracy'])

# Train model
model.fit(train_images, trans.transform(train_labels), epochs=10, verbose=0)

#export variables and model
joblib.dump(trans, 'C:\\xampp\\htdocs\\shoppee\\app\\python\\face\\trans_variable.pkl')
model.save('C:\\xampp\\htdocs\\shoppee\\app\\python\\face')

print('success')