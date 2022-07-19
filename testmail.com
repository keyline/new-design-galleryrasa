<?php

send_mail('info@galleryrasa.com', 'test', 'test', 'Gallery Rasa <info@galleryrasa.com>', '');