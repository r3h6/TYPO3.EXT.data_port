import {
	table {
		fe_users {
			identifier {
				uid = UID
			}
			fields {
				username = Vorname + '.' + Nachname
				password = password
				usergroup {
					identifier {
						title = Gruppe
					}
					fields {
						title = Gruppe
					}
				}
				email = E-Mail
				email {
					validate = EmailAddress
				}

			}
		}
	}
}