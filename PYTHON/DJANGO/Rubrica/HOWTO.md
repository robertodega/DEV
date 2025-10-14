

#   Progect creation

    mkdir reservations
    cd reservations
    python3 -m venv venv

#   Project activation

    source venv/bin/activate
    pip install django
    pip install djangorestframework
    django-admin startproject reservations .
    django-admin startapp manager
    python3 manage.py migrate
    python3 manage.py createsuperuser
    python3 manage.py runserver

#   Project population

    mkdir static static/css static/js templates
    touch static/css/custom.css static/js/custom.js templates/main.html manager/forms.py

#   Project files update

<u>in <strong>/reservations/urls.py</strong></u>

    from django.contrib import admin
    from django.urls import path, include
    from django.views.generic.base import TemplateView

    urlpatterns = [
        path('admin/', admin.site.urls),
        path('accounts/', include('django.contrib.auth.urls')),
        path("", TemplateView.as_view(template_name="main.html"), name="main"),
        path('search/', views.search, name='search'),
    ]

<u>in <strong>/reservations/settings.py</strong></u>

    ...

    INSTALLED_APPS = [
        ...
        'rest_framework',
        'manager',
    ]

    ...

    TEMPLATES = [
        {   
            ...
            'DIRS': [BASE_DIR / "templates"],
            ...

        ...

    STATICFILES_DIRS = [
        BASE_DIR / "static",
    ]


    LOGIN_REDIRECT_URL = "main"
    LOGOUT_REDIRECT_URL = "main"

<br /><br /><u>edit /templates/main.html </u>

    {% load static %}
    <!DOCTYPE HTML>
    <html>
        <head>
            <title>Reservations App</title>
            <link rel="stylesheet" href="{% static 'css/custom.css'%}" />

            <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
            
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
            
        </head>
        <body>
            <h1>Reservations Home Page</h1>
        </body>
    </html>

    <script src="{% static 'js/custom.js'%}"></script>

- <u>edit static/css/custom.css</u>
- <u>edit static/js/custom.js</u>


<br /><br /><u>edit /manager/views.py </u>

    ffrom django.shortcuts import render
    from django.http import JsonResponse
    from .models import Appointment, Anagrafica
    from django.views.decorators.csrf import csrf_exempt

    def search_appointment(request):
    def search_appointment_with_id(request, id):
    @csrf_exempt    
    def add_appointment(request):
    def search_anagrafica(request):
    def search_anagrafica_with_id(request, id):
    def add_anagrafica(request):

<br /><br /><u>edit /manager/models.py </u>

    from django.db import models

    class Appointment(models.Model):
        id = models.AutoField(primary_key=True)
        email = models.EmailField(null=False)
        first_name = models.CharField(max_length=30, null=True, blank=True)
        last_name = models.CharField(max_length=30, null=True, blank=True)
        reservation_date = models.DateTimeField()
        reservation_hour = models.TimeField(null=True, blank=True)
        created_at = models.DateTimeField(auto_now_add=True)
        updated_at = models.DateTimeField(auto_now=True)
        
        def __str__(self):
            return f"Appointment {self.id} for {self.email}"
        
    class Anagrafica(models.Model):
        id = models.AutoField(primary_key=True)
        #   appointment = models.OneToOneField(Appointment, on_delete=models.CASCADE)
        email = models.EmailField(unique=True)
        first_name = models.CharField(max_length=30, null=True, blank=True)
        last_name = models.CharField(max_length=30, null=True, blank=True)
        is_active = models.BooleanField(default=True)
        address = models.CharField(max_length=255, null=True, blank=True)
        phone_number = models.CharField(max_length=15, null=True, blank=True)
        date_of_birth = models.DateField(null=True, blank=True)
        
        def __str__(self):
            return f"Anagrafica for Appointment {self.appointment.id}"


- cd/reservations
- python3 manage.py makemigrations
- python3 manage.py migrate

#   functionality updates

<u>in <strong>/reservations/urls.py</strong></u>

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

#   Project RUN

- source venv/bin/activate
- python3 manage.py runserver

