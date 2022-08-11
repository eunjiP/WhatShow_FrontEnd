import requests
from bs4 import BeautifulSoup

test_url = 'https://movie.naver.com/movie/bi/mi/basic.naver?code=81888'
response = requests.get(test_url)
html = response.text
soup = BeautifulSoup(html, 'html.parser')
story_title = soup.select('#content > div > div > div > div > div > h5')
story = soup.select('#content > div.article > div.section_group.section_group_frst > div:nth-child(1) > div > div.story_area > p')


f = open('./movie_title.txt', 'w', encoding='utf-8')
for title in story_title:
    f.write(title.text)
    f.write('\t')
for movie_s in story:
    f.write(movie_s.text)
    f.write('\n')
f.close()

# f = open('./movie_image.txt', 'w', encoding='utf-8')
# f.write(story_title)
# f.write(story)
# f.close()

# test_url = "https://movie.naver.com/movie/bi/mi/basic.naver?code=81888"
# resp = requests.get(test_url)
# html = BeautifulSoup(resp.content, 'html.parser')

# score_result = html.find('div', {'class': 'story_area'})
# score_result = html.find('div', {'class': 'video'})
# score_result = html.find('div', {'class': 'section_group'}).find('div')
# div = score_result.findAll('div')


# h_tx_story = score_result[1].find('h5').getText()
# h_tx_story

# con_tx = score_result[1].find('p').getText()
# con_tx



# summary = score_result.findAll('story_area')
# h_tx_story = summary.find_all('h5', class_='h_tx_story')[0].getText()
# con_tx =  summary.find('p').getText()




#  ----------------------------------------------

# from urllib.request import urlopen
# import requests
# from bs4 import BeautifulSoup

# test_url = "https://movie.naver.com/movie/bi/mi/basic.naver?code=81888"
# resp = requests.get(test_url)
# html = BeautifulSoup(resp.content, 'html.parser')

# for html in movie_url:
#     try:
#         with requests.request.urlopen(url) as url:
#             doc = url.read()
#             soup = BeautifulSoup(doc, "html.parser")
            
#             title = soup.find_all("title")[0].text.strip()[:-9]
#             naver = soup.find_all("p", class_="con_tx")[0].text.strip()
#             sumarry.loc[count] = [title, naver]
#             count+=1
            
#     except:
#         pass 


#  ------------------------------------------------
# import requests
# from bs4 import BeautifulSoup

# response = requests.get("https://www.naver.com")
# bs = BeautifulSoup(response.text, "html.parser")
# print(bs.select("a"))



#  ------------------------------------------------
# import requests
# response = requests.get("https://www.naver.com")

# print(response.status_code)
# print(response.headers['content-type'])
# print(response.encoding)
# print(response.text)



