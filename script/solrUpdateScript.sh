#!/bin/bash

# Set the Solr URL
SOLR_URL="http://localhost:8983/solr/BooksSolr/update/json/docs"

# Path to your JSON file containing book data
JSON_FILE="../data/cleaned_data.json"

# Loop through each book in the JSON file
cat "$JSON_FILE" | jq -c '.[]' | while read -r book; do
    # Send the book object to Solr using curl
    curl -X POST -H "Content-Type: application/json" --data-binary "$book" "$SOLR_URL"
done
