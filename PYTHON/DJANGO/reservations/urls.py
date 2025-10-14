from django.contrib import admin
from django.urls import path, include
from django.views.generic.base import TemplateView
from manager import views

urlpatterns = [
    path('admin/', admin.site.urls),
    path('accounts/', include('django.contrib.auth.urls')),
    path("", TemplateView.as_view(template_name="main.html"), name="main"),
    path('search_appointment/', views.search_appointment, name='search_appointment'),
    path('search_appointment/<int:id>/', views.search_appointment_with_id, name='search_appointment_with_id'),
    path('add_appointment/', views.add_appointment, name='add_appointment'),
    path('search_anagrafica/', views.search_anagrafica, name='search_anagrafica'),
    path('search_anagrafica/<int:id>/', views.search_anagrafica_with_id, name='search_anagrafica_with_id'),
    path('add_anagrafica/', views.add_anagrafica, name='add_anagrafica'),
]