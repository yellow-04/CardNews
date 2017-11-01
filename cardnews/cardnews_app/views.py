#-*-coding:utf-8-*-
from django.shortcuts import render
from django.http import HttpResponse
# Create your views here.

def main_page(request):
    output = '''
    <html>
        <head><title>%s</title></head>
            <body>
                <h1>%s</h1><p>%s</p>
            </body>
        </html>
    '''%(
        '장고 | 북마크'
        '장고 북마크에 오신 것을 환영합니다'
        '여기 북마크를 저장하고 공유할 수 있습니다.'
    )
    return HttpResponse(output)
