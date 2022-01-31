pub type Matrix = Vec<Vec<f32>>;

pub fn generate_identity_matrix(n: usize) -> Matrix {
    let mut matrix = vec![vec![0.0; n]; n];
    for i in 0..n {
        matrix[i][i] = 1.0;
    }
    matrix
}
