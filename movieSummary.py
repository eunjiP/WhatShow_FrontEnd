# import code
# from turtle import title
# from urllib import response
# import requests
# from bs4 import BeautifulSoup

# code = ''
# result = []

# for code in code:
#     url = 'https://movie.naver.com/movie/bi/mi/basic.naver?code=' + code

#     response = requests.get(url)
#     response.raise_for_status()
#     html = response.text
#     soup = BeautifulSoup(html,'html.parser')

#     # summary = soup.select_one('#content > div.article > div.section_group.section_group_frst > div:nth-child(1) > div.video > div.story_area > h5.h_tx_story')
#     # summaryTitle = summary.select('h5.h_tx_story').
#     # summaryText = summary.select('p.con_tx')
#     summaryTitle = soup.select_one('#content > div.article > div.section_group.section_group_frst > div:nth-child(1) > div.video > div.story_area > h5.h_tx_story')
#     summaryText = soup.select_one('#content > div.article > div.section_group.section_group_frst > div:nth-child(1) > div.video > div.story_area > p.con_tx')
#     summaryAll = summaryTitle + summaryText
#     # result.append(summaryTitle.get_text())
#     result = summaryAll.select_one('.blind')
#     result.append(summaryTitle.get_text())
# print(result)