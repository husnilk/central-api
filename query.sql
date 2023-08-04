-- KERJA PRAKTEK --

-- Mahasiswa : Cek list KP mahasiswa
SELECT
internships.id AS id,
internship_agencies.name AS agency,
internships.report_title AS title,
internships.start_at AS start_at,
internships.end_at AS end_at,
internships.`status` AS `status`,
internships.supervisor_id as supervisor_id,
lecturers.name AS supervisor,
internships.grade as grade
FROM internships
LEFT JOIN internship_proposals ON internships.proposal_id = internship_proposals.id
LEFT JOIN internship_agencies ON internship_proposals.agency_id = internship_agencies.id
LEFT JOIN lecturers ON lecturers.id = internships.supervisor_id
WHERE internships.student_id = 1
ORDER BY internships.start_at;

-- Mahasiswa : Detail KP Mahasiswa

