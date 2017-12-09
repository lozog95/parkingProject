CREATE EVENT remove_obsolete_reservation
    ON SCHEDULE
      EVERY 1 DAY
    COMMENT 'Removes obsolete reservations every day'
    DO
      DELETE FROM reservation 
      WHERE end < NOW()-1;   
    
CREATE EVENT remove_obsolete_release
    ON SCHEDULE
      EVERY 1 DAY
    COMMENT 'Updates slots - remove obsolete releases every day'
    DO
      UPDATE slots
      SET is_released = 0, release_start = NULL, release_end = NULL, is_reserved = 0
      WHERE release_end < NOW()-1;