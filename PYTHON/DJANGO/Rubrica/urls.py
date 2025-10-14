from django.contrib import admin
from django.urls import path, include
from django.views.generic.base import TemplateView
from usermanager import views

urlpatterns = [
    path('admin/', admin.site.urls),
    path('accounts/', include('django.contrib.auth.urls')),
    path("", TemplateView.as_view(template_name="main.html"), name="main"),
    path('search/', views.search, name='search'),
    path('search/<int:id>/', views.search_with_id, name='search_with_id'),
    path('add_contact/', views.add_contact, name='add_contact'),
]