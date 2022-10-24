from typing import List
import os

DEV_URL = "/DECO1800-7180/"
RELEASE_URL = "/"

IGNORED_DIRS = ["scripts", ".git", "front-end"]
IGNORED_FILES = [".git", ".png", ".jpg", ".jpeg", ".svg"]
TARGET_DIR = "release/"

def _is_invalid_dir(root: str):
    """ Returns true if the folder is invalid. False otherwise. """
    return any(ignored in root for ignored in IGNORED_DIRS)

def _is_invalid_file(file: str):
    """ Returns true if the file is invalid. False otherwise. """
    return any(ignored in file for ignored in IGNORED_FILES)

def _get_valid_files(files: List[str]):
    """ Filter list of files to those that are valid """
    return list(filter(lambda file: not _is_invalid_file(file), files))

def _get_dir_contents(dir: str = None):
    """ List all files in a directory that are valid """
    return os.walk(dir)

def fix_release():
    contents = _get_dir_contents(TARGET_DIR)
    
    for root, dirs, files in contents:
        if _is_invalid_dir(root):
            continue
        
        for file in _get_valid_files(files):
            file = os.path.join(root, file)

            data = None
            with open(file, "r") as target:
                contents = target.read()

                if DEV_URL in contents:
                    data = contents.replace(DEV_URL, RELEASE_URL)

            # If changes were made, update the file
            if data:
                with open(file, "w") as target:
                    target.write(data)                    
                    print(f"UPDATED file: {file}")
            else:
                print(f"Read file: {file}")

fix_release()