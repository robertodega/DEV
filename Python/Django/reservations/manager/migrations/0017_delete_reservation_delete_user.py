# Generated by Django 5.1.6 on 2025-02-28 15:53

from django.db import migrations


class Migration(migrations.Migration):

    dependencies = [
        ('manager', '0016_alter_anagrafica_email'),
    ]

    operations = [
        migrations.DeleteModel(
            name='Reservation',
        ),
        migrations.DeleteModel(
            name='User',
        ),
    ]
