# listener
Listener for Part 2 of API Challenge

## References
My references for this code are the following:
- https://lornajane.net/posts/2017/handling-incoming-webhooks-in-php
  - This site was used to read up on handling webhooks in PHP - which i am most familiar with as a web programming language. Disclaimer is that it has been many years since i wrote an actual application in PHP :) 
- https://webhook.site/#!/3c766790-7106-450c-a63f-5cd276df6711/029775ea-a30e-43bc-b011-1f3b11f43e5d/1
  - I used this site to test out my Github org API before pointing it at this listener.
- https://github.com/KnpLabs/php-github-api
  - I used this PHP Github API client to send my API calls.


### Infrastructure Requirements
- Ubuntu VM with 1 cpu, 1gb ram and 16gb disk
- nginx, php 7.2 & composer
- 1 x static IP address, 1 DNS entry and 1 x LetsEncrypt SSL cert
