PHP Vs Python

### 1. Syntaxe de Base

**Python :**

- Utilise une indentation pour délimiter les blocs de code.
- Syntaxe minimaliste, très proche du langage naturel.

```python
# Python
def ma_fonction(name):
    if name:
        print(f"Hello, {name}!")
    else:
        print("Hello, World!")

ma_fonction("Alice")
```

**PHP :**

- Utilise des accolades `{}` pour délimiter les blocs de code.
- Syntaxe plus verbeuse, nécessitant des points-virgules `;` pour terminer les instructions.

```php
<?php
// PHP
function ma_fonction($name) {
    if ($name) {
        echo "Hello, $name!";
    } else {
        echo "Hello, World!";
    }
}

ma_fonction("Alice");
?>
```

### 2. Gestion des Variables

**Python :**

- Typage dynamique : les types des variables sont déterminés automatiquement.
- Pas besoin de déclarer explicitement le type des variables.

```python
age = 25  # Integer
name = "Alice"  # String
is_student = True  # Boolean
```

**PHP :**

- Typage également dynamique.
- Les variables commencent par le symbole `$`.

```php
$age = 25;  // Integer
$name = "Alice";  // String
$is_student = true;  // Boolean
```

### 3. Structures de Contrôle

**Python :**

- `if`, `else`, `elif` pour les conditions.
- `for` et `while` pour les boucles.

```python
# Python
for i in range(5):
    print(i)

if age > 18:
    print("Adult")
else:
    print("Minor")
```

**PHP :**

- `if`, `else`, `elseif` pour les conditions.
- `for`, `while`, `foreach` pour les boucles.

```php
<?php
// PHP
for ($i = 0; $i < 5; $i++) {
    echo $i;
}

if ($age > 18) {
    echo "Adult";
} else {
    echo "Minor";
}
?>
```

### 4. Gestion des Fonctions

**Python :**

- Définition avec `def`.
- Peut retourner plusieurs valeurs sous forme de tuple.

```python
# Python
def add(a, b):
    return a + b

result = add(2, 3)
print(result)
```

**PHP :**

- Définition avec `function`.
- Retourne une seule valeur.

```php
<?php
// PHP
function add($a, $b) {
    return $a + $b;
}

$result = add(2, 3);
echo $result;
?>
```

### 5. Exemple d'Application : Calculatrice Basique

**Python :**

```python
# Python Calculator
def add(a, b):
    return a + b

def subtract(a, b):
    return a - b

def multiply(a, b):
    return a * b

def divide(a, b):
    if b == 0:
        return "Cannot divide by zero!"
    return a / b

print("Select operation:")
print("1. Add")
print("2. Subtract")
print("3. Multiply")
print("4. Divide")

choice = input("Enter choice (1/2/3/4): ")

num1 = float(input("Enter first number: "))
num2 = float(input("Enter second number: "))

if choice == '1':
    print(f"Result: {add(num1, num2)}")
elif choice == '2':
    print(f"Result: {subtract(num1, num2)}")
elif choice == '3':
    print(f"Result: {multiply(num1, num2)}")
elif choice == '4':
    print(f"Result: {divide(num1, num2)}")
else:
    print("Invalid Input")
```

**PHP :**

```php
<?php
// PHP Calculator
function add($a, $b) {
    return $a + $b;
}

function subtract($a, $b) {
    return $a - $b;
}

function multiply($a, $b) {
    return $a * $b;
}

function divide($a, $b) {
    if ($b == 0) {
        return "Cannot divide by zero!";
    }
    return $a / $b;
}

echo "Select operation:\n";
echo "1. Add\n";
echo "2. Subtract\n";
echo "3. Multiply\n";
echo "4. Divide\n";

$choice = readline("Enter choice (1/2/3/4): ");

$num1 = readline("Enter first number: ");
$num2 = readline("Enter second number: ");

if ($choice == '1') {
    echo "Result: " . add($num1, $num2);
} elseif ($choice == '2') {
    echo "Result: " . subtract($num1, $num2);
} elseif ($choice == '3') {
    echo "Result: " . multiply($num1, $num2);
} elseif ($choice == '4') {
    echo "Result: " . divide($num1, $num2);
} else {
    echo "Invalid Input";
}
?>
```

### Conclusion

Python et PHP ont des syntaxes distinctes mais partagent plusieurs concepts de base. 
Python est souvent préféré pour des scripts rapides, l'analyse de données, et le développement d'applications où la lisibilité et la simplicité sont cruciales. 
PHP est largement utilisé pour le développement web, avec une forte intégration côté serveur.

Python est idéal pour les tâches générales de programmation
PHP reste un choix dominant pour le développement d'applications web
Python est toutefois très pertinent dans le web avec de remarquables frameworks comme Django et Flask

