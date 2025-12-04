# -*- coding: utf-8 -*-

import os
import re
from pathlib import Path

def extract_translation_strings(directory):
    """Extract strings from __() functions in PHP and Blade files"""
    #translation_pattern = re.compile(r'__\([\'"](.*?)[\'"]\)')
    translation_pattern = re.compile(r'__\((.*?)\)')
    translations = set()

    for root, _, files in os.walk(directory):
        for file in files:
            if file.endswith('.php') or file.endswith('.blade.php'):
                file_path = os.path.join(root, file)
                with open(file_path, 'r', encoding='utf-8') as f:
                    try:
                        content = f.read()
                        matches = translation_pattern.findall(content)
                        for match in matches:
                            # Remove escaped quotes and add to set to avoid duplicates
                            clean_match = match.replace("\\'", "'").replace('\\"', '"')
                            translations.add(clean_match)
                    except UnicodeDecodeError:
                        print(f"Could not read file: {file_path}")

    return sorted(translations)

def extract_fillable_fields(directory):
    """Extract fillable fields from Laravel models"""
    fillable_pattern = re.compile(r'protected\s+\$fillable\s*=\s*\[(.*?)\];', re.DOTALL)
    fields = set()

    for root, _, files in os.walk(directory):
        for file in files:
            if file.endswith('.php'):
                file_path = os.path.join(root, file)
                with open(file_path, 'r', encoding='utf-8') as f:
                    try:
                        content = f.read()
                        match = fillable_pattern.search(content)
                        if match:
                            fillable_content = match.group(1)
                            # Extract each field, removing quotes and whitespace
                            field_matches = re.findall(r'[\'"](.*?)[\'"]', fillable_content)
                            for field in field_matches:
                                fields.add(field.strip())
                    except UnicodeDecodeError:
                        print(f"Could not read file: {file_path}")

    return sorted(fields)

def main():
    # Get the Laravel project path (assuming script is run outside the project)
    project_path = "C:/laragon/www/apps/your-business-partner"
    
    # Validate path
    if not os.path.exists(project_path):
        print("Error: The specified path does not exist.")
        return
    
    # Set up paths to scan
    views_path = os.path.join(project_path, 'resources', 'views', 'welcome')
    
    # Extract translations
    views_translations = extract_translation_strings(views_path)
    all_translations = views_translations
    all_translations_unique = sorted(set(all_translations))  # Remove duplicates
    
    # Write to files
    with open('translation.txt', 'w', encoding='utf-8') as f:
        for item in all_translations_unique:
            f.write(f"{item}\n")

    
    print(f"Found {len(all_translations_unique)} unique translation strings (saved to translation.txt)")

if __name__ == "__main__":
    main()