import json

# Load the JSON data
with open('unique_cleaned_data.json', 'r') as file:
    data = json.load(file)

# Iterate through each book and remove "Published " from the published date if it exists
for book in data:
    if 'published' in book and book['published'] and book['published'].startswith('Published '):
        book['published'] = book['published'].replace('Published ', '')

# Save the updated JSON data
with open('unique_cleaned_data_updated.json', 'w') as file:
    json.dump(data, file, indent=4)
