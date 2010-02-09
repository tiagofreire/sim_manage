# Be sure to restart your server when you modify this file.

# Your secret key for verifying cookie session data integrity.
# If you change this key, all old sessions will become invalid!
# Make sure the secret is at least 30 characters and all random, 
# no regular words or you'll be exposed to dictionary attacks.
ActionController::Base.session = {
  :key         => '_sim_manage_session',
  :secret      => '28498ce95a0c7981ce418a87239e72423cd122266d0ec706fce85af76d01df9eef032cc1f494ebdd9a4e78faf5fd5a2849e1868bd9f2beff589dc2f361f0d186'
}

# Use the database for sessions instead of the cookie-based default,
# which shouldn't be used to store highly confidential information
# (create the session table with "rake db:sessions:create")
# ActionController::Base.session_store = :active_record_store
