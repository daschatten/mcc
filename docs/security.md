# Security considerations

## Authentication

The authentication mechanism of this authentication is not as strong as it could be because it only uses a password (let's call it PIN, because it's intended to use numbers, but that is not required) and no username. This is intended because of a more userfriendly experience. It is much easier to just type in a PIN instead of username and password, especially on mobile devices. In almost all cases this should be enough security for home usage, just change the admin PIN and choose a long enough PIN.

## Application accessibility

NEVER put this application directly on the internet! If you want to use this application from everywhere, then you can use

* a vpn tunnel (e.g. openvpn)
* a reverse proxy with certificate authentication
