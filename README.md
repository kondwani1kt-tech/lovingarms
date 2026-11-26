# Loving Arms Home Care, SPC — Web Application

Laravel (PHP) + MySQL + Supabase Auth, deployed on Render.

This folder is an **overlay**: it contains only the project-specific files. Drop it on top of a fresh Laravel install.

## What's included (matches the quotation)

| Quotation item | Where |
|---|---|
| Public website (Home, About, Services, Payment, Careers, Contact) | `resources/views/pages/*`, `public/css/site.css` (design taken from the current site) |
| Family and client inquiry system (database, status tracking, notes) | `SubmissionController@inquiry`, `Admin\RecordController` |
| Caregiver and CNA recruitment (applications, availability, credentials, references, status) | `SubmissionController@application`, `Admin\RecordController` |
| Secure admin panel (staff login, roles, dashboard, records) | `Admin\AuthController` (Supabase), `EnsureRole`, `Admin\DashboardController` |
| Scheduling and shift management (assign caregivers, calendar, status, double-booking check) | `Admin\ShiftController`, `Admin\ResourceController` (clients / caregivers) |
| Facility staffing requests (form + tracking) | `/staffing` page, `SubmissionController@staffing`, `Admin\RecordController` |
| Email notifications and reports | `Mail\StaffNotification`, `Services\ReportBuilder`, `report:weekly` command, `/admin/reports` |
| Deployment | `Dockerfile`, `docker/start.sh`, `render.yaml` |

## 1. Set up locally

```bash
composer create-project laravel/laravel loving-arms
# copy everything from this folder into ./loving-arms, overwriting when asked
# (bootstrap/app.php, routes/web.php and the users migration replace Laravel's defaults)
cd loving-arms
composer require resend/resend-php        # email over HTTPS
cp .env.example .env
php artisan key:generate
```

Fill in `.env` (database, Supabase, Resend, `NOTIFY_EMAIL`), then:

```bash
php artisan migrate
php artisan staff:create you@example.com "Your Name" --role=admin   # asks for a password
php artisan serve
```

Public site: http://localhost:8000 — staff area: http://localhost:8000/admin

## 2. Supabase (staff sign-in only)

1. Create a Supabase project.
2. **Authentication → Providers → Email:** turn **off** "Allow new users to sign up". Staff are created only by an administrator.
3. Copy **Project URL**, **anon key** and **service_role key** (Project Settings → API) into `SUPABASE_URL`, `SUPABASE_ANON_KEY`, `SUPABASE_SERVICE_ROLE_KEY`.
4. The `service_role` key is a secret: server-side only, never in the browser or in Git.

How it works: the login form posts to Laravel; Laravel verifies the password with Supabase, then only lets the person in if an active profile with the same email exists in the local `users` table (that table holds the role). Administrators add, disable and remove staff under **Staff logins**.

## 3. Deploy on Render

1. Push the project to GitHub.
2. Create a **MySQL database** somewhere reachable from Render (Render does not host MySQL as a managed database — use a MySQL provider such as Aiven, TiDB Cloud or Railway, or a MySQL Docker private service on Render). Put its details in `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`.
3. In Render: **New → Blueprint**, pick the repo. `render.yaml` creates the web service and a weekly-report cron job.
4. Fill the variables marked `sync: false` (`APP_KEY` from `php artisan key:generate --show`, `APP_URL`, DB, Supabase, Resend, `NOTIFY_EMAIL`).
5. Deploy. On start the container runs migrations automatically.
6. Create the first admin from the Render **Shell** tab: `php artisan staff:create admin@example.com "Name" --role=admin`
   (or create the user in the Supabase dashboard and add `--local-only`).
7. Add the custom domain in Render and set `APP_URL` to it.

Email: Render's free web services block outbound SMTP, so the app uses Resend's HTTPS API. Verify the sending domain in Resend and use an address on it for `MAIL_FROM_ADDRESS`.

## 4. Using the staff area

- **Dashboard:** new items, today's shifts, upcoming shifts with no caregiver.
- **Inquiries / Applications / Facility requests:** open a record, change its status, add notes. Export any list to CSV. Mark an application *Hired* to add the person to the caregiver roster.
- **Schedule / Shifts:** create shifts, assign a client and caregiver, change status. A caregiver cannot be double-booked.
- **Reports:** activity summary for any period, emailable on demand and sent every Monday.
- Roles: **Administrator** (everything, including staff logins and deleting records) and **Staff**.

## 5. Notes before going live

- Forms are protected by CSRF, rate limiting and a hidden honeypot field. Add Cloudflare Turnstile or reCAPTCHA if spam gets through.
- The application form deliberately does not collect SSNs, dates of birth or document uploads. Keep it that way unless the company has a plan for storing that data securely (Render's disk is ephemeral, so uploads need external storage such as S3 or Supabase Storage).
- Client records and notes can be sensitive. Keep scheduling notes to what is needed to schedule care, and have the company confirm its privacy-policy and data-handling obligations.
- The About page repeats the licensing status from the company profile. Update it once the licence is approved.
- Tests: none are included yet. Delete `tests/Feature/ExampleTest.php` if you do not run the default test suite against a database.
