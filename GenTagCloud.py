import sys
import os
import urllib2
from bs4 import BeautifulSoup
import tldextract                                          # To Extract relevant text from the URL by ignoring Domain names                                                               
from pytagcloud import create_tag_image, make_tags         # To create the tuple with tag and their tag counts
from pytagcloud.lang.counter import get_tag_counts

#print(sys.argv[1])
sterm = str(sys.argv[1])
opener = urllib2.build_opener()                            # To open the URL using Urllib2
opener.addheaders = [('User-agent', 'Mozilla/5.0')]        # To create the headers and browser

search_term=sterm.replace(" ","+")                          # To Replace the string with browser acceptable one
fileprefix=sterm.replace(" ","_")
url="https://www.google.co.in/search?num=100&site=&source=hp&q="+search_term+"&oq="+search_term   # Prepare a URL with the Query given as input
page = opener.open(url)                                                                         # Opens the URL and reads the HTML contents
soup = BeautifulSoup(page, "lxml")                                                                      # Used to view HTML content in a readable format
endstring=''

filename = os.path.expanduser('~') + 'TagCloud.png'
try:
   os.remove(filename)
except OSError:
   pass
for cite in soup.findAll('cite'):                                                               # Search for "cite" in HTML context to extract the link
   url=cite.text                                                                               # Extract the text from that particular link
   ext = tldextract.extract(url)                                                               # Extract the URL from that entire link from above
   k=ext.domain                                                                                # Extracts the relevant context from link ignoring domain names(i.e, WWW, com.in etc)
   endstring = endstring + " " +k                                                              # COmbine the required strings from all the URL's

counts = get_tag_counts(endstring)                                                              # Get the touple with word and its frequency count

tags = make_tags(counts, maxsize=40, minsize=10)                                                # Prepare the size of tags according to counts and max size would be 50
create_tag_image(tags, 'TagCloud_'+fileprefix+'.png',size=(1024, 768),background=(0, 0, 0, 255), fontname='Molengo', rectangular=True)


