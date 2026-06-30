from PIL import Image;
from sys import argv;

def storeImage():
    try:
        img = Image.open(argv[1])

    except:
        print("Failed to open " + argv[1]);
        return;
    
    img300x300 = img.resize((300, 300));
    img150x150 = img.resize((150, 150));

    img300x300.save("../300x300/" + argv[1]);
    img150x150.save("../150x150/" + argv[1]);


if __name__ == "__main__" and len(argv) > 1:
    storeImage()
