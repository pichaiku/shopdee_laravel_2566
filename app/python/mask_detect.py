from keras.models import load_model  # TensorFlow is required for Keras to work
from PIL import Image, ImageOps  # Install pillow instead of PIL
import numpy as np
import sys
import os
os.environ['TF_CPP_MIN_LOG_LEVEL'] = '1'

#Receive data
model_path = sys.argv[1]
label_path = sys.argv[2]
image_path = sys.argv[3]


# Disable scientific notation for clarity
np.set_printoptions(suppress=True)

# Load the model
model = load_model(model_path, compile=False)

# Load the labels
class_names = open(label_path, encoding="utf8").readlines()

# Create the array of the right shape to feed into the keras model
# The 'length' or number of images you can put into the array is
# determined by the first position in the shape tuple, in this case 1
data = np.ndarray(shape=(1, 224, 224, 3), dtype=np.float32)

# Replace this with the path to your image
image = Image.open(image_path).convert("RGB")

# resizing the image to be at least 224x224 and then cropping from the center
size = (224, 224)
image = ImageOps.fit(image, size, Image.Resampling.LANCZOS)

# turn the image into a numpy array
image_array = np.asarray(image)

# Normalize the image
normalized_image_array = (image_array.astype(np.float32) / 127.5) - 1

# Load the image into the array
data[0] = normalized_image_array

# Predicts the model
prediction = model.predict(data, verbose=0)
index = np.argmax(prediction)
class_name = class_names[index]
confidence_score = prediction[0][index]

# Print prediction and confidence score
#print("Class:", class_name[2:], end="")
#print("Confidence Score:", confidence_score)
print("", class_name[2:], end="")

#pip uninstall pillow
#pip install pillow
#pip uninstall h5py
#pip install h5py