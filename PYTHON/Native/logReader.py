import re

# Esempio di log: "Jun  9 12:00:00 hostname app[123]: Messaggio di log"
pattern = r'^(?P<date>\w+\s+\d+\s+\d+:\d+:\d+)\s+(?P<host>\S+)\s+(?P<proc>[\w\[\]\-]+):\s+(?P<msg>.+)$'

with open('/var/log/syslog', 'r') as f:
    for line in f:
        match = re.match(pattern, line)
        if match:
            print(match.groupdict())
        else:
            print('line without match: ' + line, end='')