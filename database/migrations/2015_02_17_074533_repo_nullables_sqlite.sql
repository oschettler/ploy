BEGIN;
CREATE TABLE "adminer_repos" (
  "id" integer NOT NULL PRIMARY KEY AUTOINCREMENT,
  "name" text NOT NULL,
  "update_script" text NULL,
  "ssh_clone_url" text NOT NULL,
  "owner_name" text NULL,
  "owner_email" text NULL,
  "created_at" numeric NOT NULL,
  "updated_at" numeric NOT NULL
);
INSERT INTO "adminer_repos" ("id", "name", "update_script", "ssh_clone_url", "owner_name", "owner_email", "created_at", "updated_at") SELECT "id", "name", "update_script", "ssh_clone_url", "owner_name", "owner_email", "created_at", "updated_at" FROM "repos";
DROP TABLE "repos";
ALTER TABLE "adminer_repos" RENAME TO "repos";
COMMIT;
