import re

path = 'H:/Pr - Traventure/Traventure_Concept_B/resources/views/components/trek-card.blade.php'
with open(path, 'r', encoding='utf-8') as f:
    content = f.read()

# Make the x-card relative
content = content.replace(
    '<x-card class="flex flex-col h-full group hover:shadow-md transition-shadow">',
    '<x-card class="flex flex-col h-full group hover:shadow-md transition-shadow relative">'
)

with open(path, 'w', encoding='utf-8') as f:
    f.write(content)
print("trek-card.blade.php updated.")
