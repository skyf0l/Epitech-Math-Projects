pub struct Spline {
    pub min_x: f32,
    pub max_x: f32,
    pub step: f32,
    pub nb_points: usize,
    pub points: Vec<(f32, f32)>,
    pub vector: Vec<f32>,
}

pub fn compute_spline(points: Vec<(f32, f32)>) -> Spline {
    // compute resolved linear system’s vector of spline
    let mut vector = vec![0.0; points.len() as usize];

    let mut tmp_vector = vec![];
    for i in 1..(points.len() - 1) {
        let value = 6.0 * (points[i + 1].1 - 2.0 * points[i].1 + points[i - 1].1) / 50.0;
        tmp_vector.push(value);
    }
    vector[2] = (tmp_vector[1] - (tmp_vector[0] + tmp_vector[2]) / 4.0) * 4.0 / 7.0;
    vector[1] = tmp_vector[0] / 2.0 - 0.25 * vector[2];
    vector[3] = tmp_vector[2] / 2.0 - 0.25 * vector[2];

    Spline {
        min_x: points[0].0,
        max_x: points[points.len() - 1].0,
        step: points[1].0 - points[0].0,
        nb_points: points.len(),
        vector,
        points,
    }
}

pub fn generate_new_points(spline: &Spline, n: i32) -> Vec<(f32, f32)> {
    // generate new points
    let mut generated_points: Vec<(f32, f32)> = vec![];

    for i in 0..n {
        // calculate x coordinate
        let x = spline.min_x + (spline.max_x - spline.min_x) * i as f32 / (n - 1) as f32;
        // get nearest vector index
        let p = ((x - 0.01) / spline.step).floor() as usize + 1;
        // calculate y coordinate
        let y = spline.vector[p as usize] / 30.0
            * f32::powf(x - spline.points[(p - 1) as usize].0, 3.0)
            - spline.vector[(p - 1) as usize] / 30.0
                * f32::powf(x - spline.points[p as usize].0, 3.0)
            + (spline.points[p as usize].1 / spline.step
                - spline.step / (spline.nb_points as f32 + 1.0) * spline.vector[p as usize])
                * (x - spline.points[(p - 1) as usize].0)
            - (spline.points[(p - 1) as usize].1 / spline.step
                - spline.step / (spline.nb_points as f32 + 1.0) * spline.vector[(p - 1) as usize])
                * (x - spline.points[p as usize].0);

        // add point to vector
        generated_points.push((x, y));
    }
    generated_points
}
