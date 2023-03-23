import urllib.request
import os
from setuptools import setup, find_packages

# Download the SQLmap source archive
url = 'https://github.com/sqlmapproject/sqlmap/zipball/master'
filename = 'sqlmap.zip'
urllib.request.urlretrieve(url, filename)

# Extract the SQLmap archive
os.system(f'unzip {filename}')

setup(
    name='mybank',
    version='0.1',
    packages=find_packages(),
    install_requires=[
        f'{os.path.basename(filename).replace(".zip","")}'
    ],
    entry_points={
        'console_scripts': [
            'mybank=mybank.main:main'
        ]
    }
)
