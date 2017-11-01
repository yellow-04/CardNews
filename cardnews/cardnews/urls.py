from django.conf.urls import *
from django.contrib import admin
from cardnews_app.views import *

urlpatterns = [
    url(r'^$', main_page),
]
