from PIL import Image
import os
import datetime

def resize_image(image_path, new_width, new_height, maintain_ratio=True):
    
    # On vérifie si le fichier existe
    if not os.path.exists(image_path):
        print(f"Le fichier spécifié est introuvable : {image_path}")
        return
    
    # On ouvre l'image en utilisant la classe Image issue de PIL
    image = Image.open(image_path)

    if maintain_ratio:
        # On calcule le ratio pour respecter la proportion de l'image originale
        ratio = min(new_width / image.width, new_height / image.height)
        resized_width = int(image.width * ratio)
        resized_height = int(image.height * ratio)
    else:
        # L'utilisateur souhaite déformer l'image, on applique donc scrupuleusement les nouvelles dimensions
        resized_width = new_width
        resized_height = new_height

    # On redimensionne l'image
    resized_image = image.resize((resized_width, resized_height))

    # On génère le nouveau nom de fichier avec la date et l'heure actuelles
    current_time = datetime.datetime.now().strftime("%Y%m%d%H%M%S")
    base_name, ext = os.path.splitext(os.path.basename(image_path))
    resized_image_name = f"{base_name}_Py_{current_time}{ext}"
    resized_image_path = os.path.join(os.path.dirname(image_path), resized_image_name)

    # On enregistre l'image redimensionnée
    resized_image.save(resized_image_path)

    print(f"Image enregistrée sous : {resized_image_path}")




if __name__ == "__main__":
    # On demande à l'utilisateur le chemin de l'image
    image_path = input("Entrez le chemin de l'image : ")

    # On demande la nouvelle largeur et hauteur
    new_width = int(input("Entrez la nouvelle largeur (max) : "))
    new_height = int(input("Entrez la nouvelle hauteur (max) : "))

    # On demande à l'utilisateur s'il souhaite maintenir le ratio
    maintain_ratio = input("Voulez-vous maintenir le ratio d'aspect ? (oui/non) : ").lower() == "oui"

    # On utilise la fonction déclarée plus haut pour redimensionner l'image
    resize_image(image_path, new_width, new_height, maintain_ratio)
    
    
